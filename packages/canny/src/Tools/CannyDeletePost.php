<?php
namespace OpenCompany\Integrations\Canny\Tools;
/** Delete a Canny post. */
class CannyDeletePost extends AbstractCannyTool { protected const NAME = 'canny_delete_post'; protected const DESCRIPTION = 'Delete a Canny post by ID.'; protected const OPERATION = 'delete_post'; protected const REQUIRED = ['id']; }
