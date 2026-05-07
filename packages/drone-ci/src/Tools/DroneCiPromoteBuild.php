<?php

namespace OpenCompany\Integrations\DroneCi\Tools;

/** Promote one Drone build. */
class DroneCiPromoteBuild extends AbstractDroneCiTool { protected const NAME = 'drone_ci_promote_build'; protected const DESCRIPTION = 'Promote one Drone build with target and optional parameters.'; protected const METHOD = 'promoteBuild'; protected const REQUIRED = ['owner', 'repo', 'build']; protected const PARAMETERS = ['owner' => ['type' => 'string', 'required' => true, 'description' => 'Repository owner.'], 'repo' => ['type' => 'string', 'required' => true, 'description' => 'Repository name.'], 'build' => ['type' => 'integer', 'required' => true, 'description' => 'Build number.'], 'target' => ['type' => 'string', 'description' => 'Promotion target.'], 'query' => ['type' => 'object', 'description' => 'Additional promotion query parameters.']]; }
