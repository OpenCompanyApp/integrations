<?php
namespace OpenCompany\Integrations\Canny\Tools;
/** Delete a Canny company. */
class CannyDeleteCompany extends AbstractCannyTool { protected const NAME = 'canny_delete_company'; protected const DESCRIPTION = 'Delete a Canny company by ID.'; protected const OPERATION = 'delete_company'; protected const REQUIRED = ['id']; }
