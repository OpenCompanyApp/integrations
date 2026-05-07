<?php
namespace OpenCompany\Integrations\Canny\Tools;
/** Find or create a Canny user with the deprecated endpoint. */
class CannyFindOrCreateUser extends AbstractCannyTool { protected const NAME = 'canny_find_or_create_user'; protected const DESCRIPTION = 'Find or create a Canny user using Canny\'s deprecated endpoint. Prefer canny_create_or_update_user.'; protected const OPERATION = 'find_or_create_user'; protected const REQUIRED = ['name']; }
