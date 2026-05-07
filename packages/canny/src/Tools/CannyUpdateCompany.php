<?php
namespace OpenCompany\Integrations\Canny\Tools;
/** Update a Canny company. */
class CannyUpdateCompany extends AbstractCannyTool { protected const NAME = 'canny_update_company'; protected const DESCRIPTION = 'Update Canny company fields by company ID.'; protected const OPERATION = 'update_company'; protected const REQUIRED = ['id']; }
