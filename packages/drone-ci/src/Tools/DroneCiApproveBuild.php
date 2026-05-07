<?php

namespace OpenCompany\Integrations\DroneCi\Tools;

/** Approve one Drone build. */
class DroneCiApproveBuild extends AbstractDroneCiTool { protected const NAME = 'drone_ci_approve_build'; protected const DESCRIPTION = 'Approve one Drone build.'; protected const METHOD = 'approveBuild'; protected const REQUIRED = ['owner', 'repo', 'build']; protected const PARAMETERS = ['owner' => ['type' => 'string', 'required' => true, 'description' => 'Repository owner.'], 'repo' => ['type' => 'string', 'required' => true, 'description' => 'Repository name.'], 'build' => ['type' => 'integer', 'required' => true, 'description' => 'Build number.']]; }
