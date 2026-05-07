<?php
namespace OpenCompany\Integrations\Canny\Tools;
/** Delete a Canny idea. */
class CannyDeleteIdea extends AbstractCannyTool { protected const NAME = 'canny_delete_idea'; protected const DESCRIPTION = 'Delete a Canny idea by ID.'; protected const OPERATION = 'delete_idea'; protected const REQUIRED = ['id']; }
