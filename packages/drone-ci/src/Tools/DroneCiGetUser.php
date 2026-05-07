<?php

namespace OpenCompany\Integrations\DroneCi\Tools;

/** Get one Drone user. */
class DroneCiGetUser extends AbstractDroneCiTool { protected const NAME = 'drone_ci_get_user'; protected const DESCRIPTION = 'Get one Drone user by login. Requires a token with sufficient server privileges.'; protected const METHOD = 'getUser'; protected const REQUIRED = ['login']; protected const PARAMETERS = ['login' => ['type' => 'string', 'required' => true, 'description' => 'Drone user login.']]; }
