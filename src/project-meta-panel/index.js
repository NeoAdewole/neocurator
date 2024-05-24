/**
 * WordPress dependencies
 * 
 * These will enable you plugins to integrate with the block system
 */
import { registerPlugin } from '@wordpress/plugins';
// import { RichText } from '@wordpress/block-editor'
import { PluginDocumentSettingPanel } from '@wordpress/edit-post';
import { __ } from '@wordpress/i18n';
import { useEntityProp } from '@wordpress/core-data';
import { useSelect } from '@wordpress/data';
import { PanelBody, TextControl, DatePicker, SelectControl } from '@wordpress/components';

const ProjectMeta = () => {
  // Get the value of mera and a function for updating meta from useEntityProp.
  const [meta, setMeta] = useEntityProp('postType', 'project', 'meta');
  const { title } = useSelect(
    (select) => {
      return {
        title: select('core/editor').getEditedPostAttribute('title')
      }
    },
    []
  );

  const {
    'project-start': projectStart,
    'project-duration': projectDuration,
    'project-name': projectName,
    'project-type': projectType,
    'project-status': projectStatus,
  } = meta;

  const projectTypes = [
    { label: 'Design', value: 'design' },
    { label: 'Development', value: 'development' },
    { label: 'Writing', value: 'writing' },
    { label: 'Video', value: 'video' },
    { label: 'Management', value: 'management' },
    { label: 'Data', value: 'data' }
  ];

  const statuses = [
    { label: "Planning", value: 'planning' },
    { label: 'In-Progress', value: 'in-progress' },
    { label: 'Blocked', value: 'blocked' },
    { label: 'Complete', value: 'complete' },
  ];

  return (
    <PluginDocumentSettingPanel
      name={__("Project Metadata", "neocurator")}
      title={__("Project Metadata", "neocurator")}
      className={__("project-meta", "neocurator")}
    >
      <TextControl
        label={__("Project Name", "neocurator")}
        value={projectName || title}
        onChange={(newText) => { setMeta({ 'project-name': newText }) }}
      />
      <h3>{__('Start Date', 'neocuration')}</h3>
      <DatePicker
        label={__('Project Start Date', 'neocurator')}
        currentDate={projectStart}
        onChange={(newDate) => {
          setMeta({
            ...meta,
            'project-start': newDate,
          });
        }}
      />
      <TextControl
        label={__('Project Duration', 'neocuration')}
        value={projectDuration}
        onChange={(newText) => {
          setMeta({
            ...meta,
            'project-duration': newText,
          });
        }}
      />
      <SelectControl
        label={__('Project Type', 'neocuration')}
        value={projectType}
        options={projectTypes}
        onChange={(selection) => { setMeta({ ...meta, 'project-type': selection }) }}
      />
      <SelectControl
        label={__('Project Status', 'neocuration')}
        value={projectStatus}
        options={statuses}
        onChange={(selection) => { setMeta({ ...meta, 'project-status': selection }) }}
      />
    </PluginDocumentSettingPanel>
  )
};

registerPlugin('neocurator-project-meta', {
  render: ProjectMeta,
  icon: 'customPostType'
})