<?php

namespace OpenCompany\Integrations\DroneCi\Tools;

/** Change Drone repository ownership. */
class DroneCiChownRepo extends AbstractDroneCiTool { protected const NAME = 'drone_ci_chown_repo'; protected const DESCRIPTION = 'Change Drone repository ownership.'; protected const METHOD = 'chownRepo'; protected const REQUIRED = ['owner', 'repo']; protected const PARAMETERS = ['owner' => ['type' => 'string', 'required' => true, 'description' => 'Repository owner.'], 'repo' => ['type' => 'string', 'required' => true, 'description' => 'Repository name.']]; }
