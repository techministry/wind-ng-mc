-- Add per-user template preference (nullable, falls back to site default)
ALTER TABLE `users`
  ADD COLUMN `theme` VARCHAR(32) NULL DEFAULT NULL AFTER `language`;

-- (Optional) backfill with site default for existing users
-- UPDATE `users` SET `theme` = NULL;
