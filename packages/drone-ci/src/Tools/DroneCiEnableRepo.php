<?php

namespace OpenCompany\Integrations\DroneCi\Tools;

/** Enable a Drone repository. */
class DroneCiEnableRepo extends AbstractDroneCiTool { protected const NAME = 'drone_ci_enable_repo'; protected const DESCRIPTION = 'Enable a repository in Drone.'; protected const METHOD = 'enableRepo'; protected const REQUIRED = ['owner', 'repo']; protected const PARAMETERS = ['owner' => ['type' => 'string', 'required' => true, 'description' => 'Repository owner.'], 'repo' => ['type' => 'string', 'required' => true, 'description' => 'Repository name.']]; }
