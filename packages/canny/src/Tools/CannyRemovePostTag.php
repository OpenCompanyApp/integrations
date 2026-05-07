<?php
namespace OpenCompany\Integrations\Canny\Tools;
/** Remove a tag from a Canny post. */
class CannyRemovePostTag extends AbstractCannyTool { protected const NAME = 'canny_remove_post_tag'; protected const DESCRIPTION = 'Remove a tag from a Canny post.'; protected const OPERATION = 'remove_post_tag'; protected const REQUIRED = ['postID', 'tagID']; }
