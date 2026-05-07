<?php

namespace OpenCompany\Integrations\Apify\Tools;

/**
 * List default request queue's requests.
 *
 * Executes the official Apify API operation actorRun_requestQueue_requests_get.
 */
class ApifyActorRunRequestQueueRequestsGet extends AbstractApifyOperationTool
{
    protected const OPERATION = 'apify_actor_run_request_queue_requests_get';
}
