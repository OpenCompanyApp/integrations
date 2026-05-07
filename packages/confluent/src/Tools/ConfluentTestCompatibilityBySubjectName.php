<?php

namespace OpenCompany\Integrations\Confluent\Tools;

/**
 * Test input schema against a particular version of a subject's schema for compatibility. The compatibility level applied for the check is the configured compatibility level for the subject http:get:: /config/string: subject. If this subject's compatibility level was never changed, then the global compatibility level applies http:get:: /config.
 */
class ConfluentTestCompatibilityBySubjectName extends AbstractConfluentOperationTool
{
    protected const TOOL_NAME = 'confluent_test_compatibility_by_subject_name';
}
