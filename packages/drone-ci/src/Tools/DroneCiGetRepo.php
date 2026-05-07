<?php

namespace OpenCompany\Integrations\DroneCi\Tools;

/** Get one Drone repository. */
class DroneCiGetRepo extends AbstractDroneCiTool { protected const NAME = 'drone_ci_get_repo'; protected const DESCRIPTION = 'Get one Drone repository by owner and repo.'; protected const METHOD = 'getRepo'; protected const REQUIRED = ['owner', 'repo']; protected const PARAMETERS = ['owner' => ['type' => 'string', 'required' => true, 'description' => 'Repository owner.'], 'repo' => ['type' => 'string', 'required' => true, 'description' => 'Repository name.']]; }
