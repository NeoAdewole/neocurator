import { registerBlockType } from '@wordpress/blocks';
import Edit from './edit.js';
import Save from './save.js';
import metadata from './block.json';
import './style.scss';

registerBlockType(
  metadata,
  {
    edit: Edit,
    save: Save
  }
)