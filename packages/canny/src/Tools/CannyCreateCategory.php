<?php
namespace OpenCompany\Integrations\Canny\Tools;
/** Create a Canny category. */
class CannyCreateCategory extends AbstractCannyTool { protected const NAME = 'canny_create_category'; protected const DESCRIPTION = 'Create a Canny category for a board.'; protected const OPERATION = 'create_category'; protected const REQUIRED = ['boardID', 'name']; }
