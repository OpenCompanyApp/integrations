<?php

namespace OpenCompany\Integrations\Pagerduty\Tools;

/**
 * Get impacted Business Services for a Status Dashboard by `url_slug`.
 *
 * Generated PagerDuty REST API tool for GET /status_dashboards/url_slugs/{url_slug}/service_impacts.
 */
class PagerdutyGetStatusDashboardServiceImpactsByUrlSlug extends AbstractPagerdutyOperationTool
{
    protected const TOOL_NAME = 'pagerduty_get_status_dashboard_service_impacts_by_url_slug';
}