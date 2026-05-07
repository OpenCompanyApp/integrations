<?php

namespace OpenCompany\Integrations\Confluent\Tools;

/**
 * Register a new schema under the specified subject. If successfully registered, this returns the unique identifier of this schema in the registry. The returned identifier should be used to retrieve this schema from the schemas resource and is different from the schema's version which is associated with the subject. If the same schema is registered under a different subject, the same identifier will be returned. However, the version of the schema may be different under different subjects. A schema should be compatible with the previously registered schema or schemas if there are any as per the configured compatibility level. The configured compatibility level can be obtained by issuing a GET http:get:: /config/string: subject. If that returns null, then GET http:get:: /config When there are multiple instances of Schema Registry running in the same cluster, the schema registration request will be forwarded to one of the instances designated as the primary. If the primary is not available, the client will get an error code indicating that the forwarding has failed.
 */
class ConfluentRegister extends AbstractConfluentOperationTool
{
    protected const TOOL_NAME = 'confluent_register';
}
