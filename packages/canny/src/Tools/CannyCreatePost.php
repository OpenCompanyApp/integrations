<?php
namespace OpenCompany\Integrations\Canny\Tools;
/** Create a Canny post. */
class CannyCreatePost extends AbstractCannyTool { protected const NAME = 'canny_create_post'; protected const DESCRIPTION = 'Create a Canny feedback post.'; protected const OPERATION = 'create_post'; protected const REQUIRED = ['boardID', 'title', 'authorID']; }
