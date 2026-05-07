<?php
namespace OpenCompany\Integrations\Canny\Tools;
/** Delete a Canny comment. */
class CannyDeleteComment extends AbstractCannyTool { protected const NAME = 'canny_delete_comment'; protected const DESCRIPTION = 'Delete a Canny comment by ID.'; protected const OPERATION = 'delete_comment'; protected const REQUIRED = ['id']; }
