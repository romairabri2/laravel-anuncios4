/*const { defineAbility} = require('@casl/ability');

export default defineAbility((can, cannot) => {
  can('manage', 'all');
  can('create', 'all');
  cannot('delete', 'User');
});*/

import { defineAbility } from '@casl/ability';

export default defineAbility((can, cannot) => {
  can('create', 'Post');

});


