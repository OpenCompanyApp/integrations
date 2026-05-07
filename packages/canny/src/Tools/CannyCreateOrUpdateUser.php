<?php
namespace OpenCompany\Integrations\Canny\Tools;
/** Create or update a Canny user. */
class CannyCreateOrUpdateUser extends AbstractCannyTool { protected const NAME = 'canny_create_or_update_user'; protected const DESCRIPTION = 'Create or update a Canny user.'; protected const OPERATION = 'create_or_update_user'; protected const REQUIRED = ['name']; }
