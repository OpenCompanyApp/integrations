<?php
namespace OpenCompany\Integrations\Canny\Tools;
/** Delete a Canny user. */
class CannyDeleteUser extends AbstractCannyTool { protected const NAME = 'canny_delete_user'; protected const DESCRIPTION = 'Delete a Canny user by ID.'; protected const OPERATION = 'delete_user'; protected const REQUIRED = ['id']; }
