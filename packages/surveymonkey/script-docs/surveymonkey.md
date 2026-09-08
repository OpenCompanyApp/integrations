# SurveyMonkey — Ruby API Reference

## list_surveys

List all surveys in your SurveyMonkey account.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination (default: 1) |
| `per_page` | integer | no | Number of surveys per page (default: 50, max: 100) |

### Examples

```ruby
result = app.integrations.surveymonkey.list(page: 1, per_page: 10)
result.data.each do |survey|
  puts((survey.id).to_s + ": " + (survey.title).to_s)
end
```
---

## get_survey

Get details of a specific survey by ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `survey_id` | string | yes | The survey ID |

### Examples

```ruby
result = app.integrations.surveymonkey.get(survey_id: "123456789")
puts("Title: " + (result.title).to_s)
puts("Questions: " + (result.pages.length).to_s)
```
---

## create_survey

Create a new blank survey with a given title.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `title` | string | yes | The title for the new survey |

### Examples

```ruby
result = app.integrations.surveymonkey.create(title: "Customer Satisfaction Q1")
puts("Created survey: " + (result.id).to_s)
```
---

## list_responses

List all bulk responses for a survey.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `survey_id` | string | yes | The survey ID |
| `page` | integer | no | Page number for pagination (default: 1) |
| `per_page` | integer | no | Number of responses per page (default: 50, max: 100) |

### Examples

```ruby
result = app.integrations.surveymonkey.list_responses(survey_id: "123456789", per_page: 25)
result.data.each do |response|
  puts((response.id).to_s + " - " + (response.date_modified).to_s)
end
```
---

## get_response

Get a single response for a survey by response ID.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `survey_id` | string | yes | The survey ID |
| `response_id` | string | yes | The response ID |

### Examples

```ruby
result = app.integrations.surveymonkey.get_response(survey_id: "123456789", response_id: "987654321")
puts("Respondent: " + ((result.recipient_email || "anonymous")).to_s)
result.pages.each do |page|
  page.answers.each do |answer|
    puts("Q" + (answer.question_id).to_s + ": " + ((answer.text || "selected")).to_s)
  end
end
```
---

## list_collectors

List all collectors for a survey.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `survey_id` | string | yes | The survey ID |

### Examples

```ruby
result = app.integrations.surveymonkey.list_collectors(survey_id: "123456789")
result.data.each do |collector|
  puts((collector.id).to_s + ": " + (collector.name).to_s + " (" + (collector.type).to_s + ")")
end
```
---

## create_collector

Create a collector for distributing a survey.

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `survey_id` | string | yes | The survey ID |
| `type` | string | yes | Collector type: `"weblink"` or `"email"` |
| `name` | string | no | A display name for the collector |

### Examples

```ruby
result = app.integrations.surveymonkey.create_collector(survey_id: "123456789", type: "weblink", name: "Website Feedback Link")
puts("Collector URL: " + (result.url).to_s)
```
---

## get_current_user

Get details of the currently authenticated SurveyMonkey user.

### Parameters

None.

### Examples

```ruby
result = app.integrations.surveymonkey.get_current_user()
puts("User: " + (result.first_name).to_s + " " + (result.last_name).to_s)
puts("Email: " + (result.email).to_s)
puts("Plan: " + ((result.group_type || "free")).to_s)
```
---

## Multi-Account Usage

If you have multiple SurveyMonkey accounts configured, use account-specific namespaces:

```ruby
# Default account (always works)
# Discover the exact function and required parameters with code_read_doc.
# Explicit default (portable across setups)
# Discover the exact function and required parameters with code_read_doc.
# Named accounts
# Discover the exact function and required parameters with code_read_doc.
# Discover the exact function and required parameters with code_read_doc.
```
All functions are identical across accounts — only the credentials differ.
