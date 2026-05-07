<?php
namespace OpenCompany\Integrations\Canny\Tools;
/** Update a Canny post. */
class CannyUpdatePost extends AbstractCannyTool { protected const NAME = 'canny_update_post'; protected const DESCRIPTION = 'Update fields on a Canny post.'; protected const OPERATION = 'update_post'; protected const REQUIRED = ['id']; }
