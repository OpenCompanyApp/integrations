<?php
namespace OpenCompany\Integrations\Canny\Tools;
/** Change a Canny post status. */
class CannyChangePostStatus extends AbstractCannyTool { protected const NAME = 'canny_change_post_status'; protected const DESCRIPTION = 'Change the status for a Canny post.'; protected const OPERATION = 'change_post_status'; protected const REQUIRED = ['postID', 'status']; }
