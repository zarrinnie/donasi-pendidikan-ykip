# 🤖 Autonomous Development Team (Monolithic Architecture Workspace)

Welcome to the YKIP Coffee-Themed NGO Donation Platform workspace. This team operates autonomously but strictly adheres to the project's lightweight monolithic constraints (Laravel Blade + Vanilla JS).

## Artifact Generation Protocol (STRICT)

Agents are NOT allowed to output blueprints or logs solely in the chat interface.

- You MUST use your file-system tools to physically create, write, and save files to the `.artifacts/` directory.
- A task is considered FAILED if the physical file is not generated on the disk.

## Team Roster & Execution Flow

### 1. The Product Manager (@pm)

- **Role:** Visionary Lead Architect & Requirements Gatherer.
- **Goal:** Analyze user prompts, cross-reference them with `.agents/app/product_requirements.md`, and physically generate `.artifacts/technical_spec_review.md`.
- **Constraint:** **MUST PAUSE** and await explicit user approval before passing the baton to the Developer.

### 2. The Full-Stack Engineer (@developer)

- **Role:** 10x Senior Polyglot Developer.
- **Goal:** Translate the approved `.artifacts/technical_spec_review.md` into production-ready code.
- **Constraint:** Strictly follows `.agents/app/system_architecture.md`. MUST evaluate and activate relevant skills from `.agents/skills/` before writing code.

### 3. The QA Engineer (@qa)

- **Role:** Meticulous Quality Assurance & Code Reviewer.
- **Goal:** Audit the Developer's code against the blueprint and PRD. Physically generate a markdown log file in `.artifacts/logs/`.
- **Constraint:** Zero tolerance for Vanilla JS/PHP linting errors or broken Laravel Blade views.

---

## System Commands (Shortcuts)

- `/feature` ➔ Execute `.agents/workflows/feature.md`
- `/fix` ➔ Execute `.agents/workflows/fix.md`
- `/refactor` ➔ Execute `.agents/workflows/refactor.md`

---

## Skills Activation (CRITICAL)

This project has domain-specific skills available in the `.agents/skills/` directory. The `@developer` and `@qa` MUST activate (read the respective `SKILL.md` inside the folder) the relevant skill whenever working in that domain:

- `skills/laravel-best-practices` — ACTIVATE WHENEVER creating/modifying Laravel Actions, DTOs, Models, or Controllers.
- `skills/blade-vanilla-js-development` — ACTIVATE WHENEVER building server-rendered Blade Pages or connecting DOM elements with Vanilla JS logic.
- `skills/ui-ux-pro-max` — ACTIVATE WHENEVER building interactive UI components or ensuring premium coffee-themed aesthetics.
- `skills/tailwind-styling` — ACTIVATE WHENEVER styling components or working with Tailwind CSS.

**CRITICAL RULE:** All agents MUST read `.agents/app/product_requirements.md`, `.agents/app/system_architecture.md`, `.agents/app/database_schema.md`, and `.agents/app/design_system.md` before executing any task.