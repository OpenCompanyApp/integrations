<?php
namespace OpenCompany\Integrations\Canny\Tools;
/** Change a Canny post category. */
class CannyChangePostCategory extends AbstractCannyTool { protected const NAME = 'canny_change_post_category'; protected const DESCRIPTION = 'Change or clear the category for a Canny post.'; protected const OPERATION = 'change_post_category'; protected const REQUIRED = ['postID']; }
