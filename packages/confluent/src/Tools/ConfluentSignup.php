<?php

namespace OpenCompany\Integrations\Confluent\Tools;

/**
 * !Early Accesshttps://img.shields.io/badge/Lifecycle%20Stage-Early%20Access-%2345c6e8section/Versioning/API-Lifecycle-Policy !Request Access To Partner v2https://img.shields.io/badge/-Request%20Access%20To%20Partner%20v2-%23bc8540mailto:ccloud-api-access+partner-v2-early-access@confluent.io?subject=Request%20to%20join%20partner/v2%20API%20Early%20Access&body=I%E2%80%99d%20like%20to%20join%20the%20Confluent%20Cloud%20API%20Early%20Access%20for%20partner/v2%20to%20provide%20early%20feedback%21%20My%20Cloud%20Organization%20ID%20is%20%3Cretrieve%20from%20https%3A//confluent.cloud/settings/billing/payment%3E. Create an organization for a customer. You must pass in either an entitlement object reference a url to a previously created entitlement or entitlement details. If you pass in an entitlement object reference, we will link with the created entitlement. If you pass in the entitlement details, we will create the entitlement with the organization in a single transaction. If you pass in user details email, given name, and family name, we will create a user as well. If you do not pass in user details, you MUST call /partner/v2/signup/activate with user details to complete signup.
 */
class ConfluentSignup extends AbstractConfluentOperationTool
{
    protected const TOOL_NAME = 'confluent_signup';
}
