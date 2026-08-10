# Google Classroom

Google Classroom tools are exposed under `app.integrations.google_classroom`. This package is generated from Google's official Classroom v1 Discovery document and exposes 104 REST methods.

Use it for education workflows: courses, aliases, teachers, students, coursework, student submissions, rubrics, announcements, materials, topics, guardians, invitations, registrations, and add-on attachments.

Each method-specific tool accepts Discovery path parameters as top-level arguments, known query parameters as top-level shortcuts or inside `query`, and request resources inside `body`. Pass Classroom IDs, aliases, user IDs, or emails directly; path values are URL-encoded for the official REST API.

## Examples

```js
var courses = app.integrations.google_classroom.google_classroom_courses_list({
  pageSize: 10,
  courseStates: [ "ACTIVE" ],
})

var course = app.integrations.google_classroom.google_classroom_courses_create({
  body: {
    name: "Agent Operations",
    section: "Spring",
    ownerId: "me",
    courseState: "PROVISIONED",
  }
})

var submissions = app.integrations.google_classroom.google_classroom_courses_course_work_student_submissions_list({
  courseId: "course-123",
  courseWorkId: "work-456",
  pageSize: 20,
})
```
Returned data is the parsed JSON response from the Classroom API. Empty successful responses return `{ success = true, status = <http_status> }`.

Use read-only scopes for list/get workflows and write scopes only for tools that create, update, delete, or mutate Classroom resources. Some endpoints require teacher, student, guardian, domain administrator, or add-on developer permissions.