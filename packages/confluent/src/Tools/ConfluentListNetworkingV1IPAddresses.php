<?php

namespace OpenCompany\Integrations\Confluent\Tools;

/**
 * !General Availabilityhttps://img.shields.io/badge/Lifecycle%20Stage-General%20Availability-%2345c6e8section/Versioning/API-Lifecycle-Policy Related guide: Use Public Egress IP addresses on Confluent Cloudhttps://docs.confluent.io/cloud/current/networking/static-egress-ip-addresses.html Retrieve a sorted, filtered, paginated list of all IP Addresses.
 */
class ConfluentListNetworkingV1IPAddresses extends AbstractConfluentOperationTool
{
    protected const TOOL_NAME = 'confluent_list_networking_v1_ip_addresses';
}
