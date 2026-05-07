<?php

namespace OpenCompany\Integrations\GitGuardian\Tools;

/**
 * List GitGuardian IP addresses.
 *
 * Maps to the official GitGuardian endpoint GET /v1/ips.
 */
class GitGuardianListIpAddresses extends AbstractGitGuardianTool
{
    protected const NAME = 'gitguardian_list_ip_addresses';
    protected const DESCRIPTION = 'Get GitGuardian\'s egress IP addresses for IP allowlisting. Use these IP addresses to configure access controls and allow GitGuardian services to access your resources. This includes: - Firewall rules - Application-level IP allowlists - Network security groups - Proxy configurations - VPN allowlists

Official GitGuardian endpoint: GET /v1/ips.';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '/v1/ips';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const BODY_REQUIRED = false;
    protected const BODY_CONTENT_TYPE = 'application/json';
}
