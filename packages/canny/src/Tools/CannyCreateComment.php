<?php
namespace OpenCompany\Integrations\Canny\Tools;
/** Create a Canny comment. */
class CannyCreateComment extends AbstractCannyTool { protected const NAME = 'canny_create_comment'; protected const DESCRIPTION = 'Create a Canny comment on a post.'; protected const OPERATION = 'create_comment'; protected const REQUIRED = ['postID', 'authorID', 'value']; }
