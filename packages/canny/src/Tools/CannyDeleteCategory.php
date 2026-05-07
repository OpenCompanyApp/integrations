<?php
namespace OpenCompany\Integrations\Canny\Tools;
/** Delete a Canny category. */
class CannyDeleteCategory extends AbstractCannyTool { protected const NAME = 'canny_delete_category'; protected const DESCRIPTION = 'Delete a Canny category by categoryID.'; protected const OPERATION = 'delete_category'; protected const REQUIRED = ['categoryID']; }
