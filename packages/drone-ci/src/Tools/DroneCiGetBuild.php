<?php

namespace OpenCompany\Integrations\DroneCi\Tools;

/** Get one Drone build. */
class DroneCiGetBuild extends AbstractDroneCiTool { protected const NAME = 'drone_ci_get_build'; protected const DESCRIPTION = 'Get one Drone build by number.'; protected const METHOD = 'getBuild'; protected const REQUIRED = ['owner', 'repo', 'build']; protected const PARAMETERS = ['owner' => ['type' => 'string', 'required' => true, 'description' => 'Repository owner.'], 'repo' => ['type' => 'string', 'required' => true, 'description' => 'Repository name.'], 'build' => ['type' => 'integer', 'required' => true, 'description' => 'Build number.']]; }
