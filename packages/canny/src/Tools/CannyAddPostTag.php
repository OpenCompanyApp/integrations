<?php
namespace OpenCompany\Integrations\Canny\Tools;
/** Add a tag to a Canny post. */
class CannyAddPostTag extends AbstractCannyTool { protected const NAME = 'canny_add_post_tag'; protected const DESCRIPTION = 'Add a tag to a Canny post.'; protected const OPERATION = 'add_post_tag'; protected const REQUIRED = ['postID', 'tagID']; }
