-- implement a status_code table and use it to populate the status column in the reservations table, you can follow these steps:

-- 1. Create the status_code Table
-- Add a new table status_code to store the status codes and their corresponding descriptions.

CREATE TABLE IF NOT EXISTS `status_code` (
  `code` TINYINT NOT NULL,
  `description` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`code`)
);

-- Insert status codes
INSERT INTO `status_code` (`code`, `description`) VALUES
(4, 'pending'),
(3, 'reserved'),
(2, 'checkedIn'),
(1, 'checkedOut'),
(0, 'cancelled');

-- 2. Update the reservations Table
-- Modify the reservations table to use the status_code table for the status column.

ALTER TABLE `reservations`
  MODIFY `status` TINYINT NOT NULL,
  ADD CONSTRAINT `fk_status_code`
  FOREIGN KEY (`status`) REFERENCES `status_code`(`code`);