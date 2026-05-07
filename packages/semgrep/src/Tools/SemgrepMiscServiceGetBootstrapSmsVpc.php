<?php

namespace OpenCompany\Integrations\Semgrep\Tools;

/**
 * [Beta] Get SMS VPC Bootstrap CloudFormation Template.
 *
 * Maps to the official Semgrep Web API endpoint get /api/v1/bootstrap-sms-vpc.
 */
class SemgrepMiscServiceGetBootstrapSmsVpc extends AbstractSemgrepTool
{
    protected const NAME = 'semgrep_misc_service_get_bootstrap_sms_vpc';
    protected const DESCRIPTION = '[Beta] Get SMS VPC Bootstrap CloudFormation Template

Official Semgrep Web API endpoint: GET /api/v1/bootstrap-sms-vpc

VPC support for Managed Scans is in private beta.

Returns the Managed Scans VPC Bootstrap CloudFormation template in JSON format for setting up cross-account infrastructure.

This template creates IAM roles and policies needed for Semgrep Managed Scanning (SMS) VPC infrastructure automation,
including the semgrep-sms-vpc-automation role and EC2 Image Builder distribution roles for gVisor container runtime.

See the original AWS cloudformation template format at https://docs.aws.amazon.com/AWSCloudFormation/latest/UserGuide/template-formats.html';
    protected const PARAMETERS = array (
);
    protected const METHOD = 'get';
    protected const PATH = '/api/v1/bootstrap-sms-vpc';
    protected const PATH_PARAMS = array (
);
    protected const QUERY_PARAMS = array (
);
    protected const HEADER_PARAMS = array (
);
    protected const BODY_REQUIRED = false;
}
