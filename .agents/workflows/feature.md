---
description: Execute a complete development cycle to build a new feature using our Laravel Blade + Vanilla JS architecture.
---

# Workflow: Feature Development

**Trigger:** When the user asks to add a new feature, page, or API.
**Execution Order:** @pm -> (Wait for User) -> @developer -> @qa

**Steps:**

1. **@pm** analyzes the request, references the core documentation in `.agents/app/` (especially `system_architecture.md` and `product_requirements.md`), and drafts the backend Action architecture and frontend Blade/Vanilla JS structure in `.artifacts/technical_spec_review.md`.
2. **@pm** explicitly pauses and asks for user approval.
3. Upon approval, **@developer** implements the feature based on the spec, ensuring strict separation of concerns (Actions/DTOs for the backend, Blade/Vanilla JS for the frontend). **DO NOT use React or Inertia.**
4. **@qa** audits the code for PHP/JavaScript errors, missing imports, and architectural violations.
5. **@qa** writes the execution log into `.artifacts/logs/` and hands it back to the user.