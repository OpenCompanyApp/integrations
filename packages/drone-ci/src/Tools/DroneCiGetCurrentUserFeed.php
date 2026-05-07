<?php

namespace OpenCompany\Integrations\DroneCi\Tools;

/** Get the authenticated user's Drone activity feed. */
class DroneCiGetCurrentUserFeed extends AbstractDroneCiTool { protected const NAME = 'drone_ci_get_current_user_feed'; protected const DESCRIPTION = 'Get the authenticated user activity feed.'; protected const METHOD = 'getCurrentUserFeed'; protected const PARAMETERS = ['query' => ['type' => 'object', 'description' => 'Pagination query parameters.']]; }
