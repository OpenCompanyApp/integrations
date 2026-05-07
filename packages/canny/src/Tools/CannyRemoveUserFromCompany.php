<?php
namespace OpenCompany\Integrations\Canny\Tools;
/** Remove a Canny user from a company. */
class CannyRemoveUserFromCompany extends AbstractCannyTool { protected const NAME = 'canny_remove_user_from_company'; protected const DESCRIPTION = 'Remove a Canny user from a company.'; protected const OPERATION = 'remove_user_from_company'; protected const REQUIRED = ['id', 'companyID']; }
