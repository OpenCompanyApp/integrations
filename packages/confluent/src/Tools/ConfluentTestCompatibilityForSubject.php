<?php

namespace OpenCompany\Integrations\Confluent\Tools;

/**
 * Test input schema against a subject's schemas for compatibility, based on the configured compatibility level of the subject. In other words, it will perform the same compatibility check as register for that subject. The compatibility level applied for the check is the configured compatibility level for the subject http:get:: /config/string: subject. If this subject's compatibility level was never changed, then the global compatibility level applies http:get:: /config.
 */
class ConfluentTestCompatibilityForSubject extends AbstractConfluentOperationTool
{
    protected const TOOL_NAME = 'confluent_test_compatibility_for_subject';
}
