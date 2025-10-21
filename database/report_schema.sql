-- Report database schema (MySQL)
-- This creates a light reporting store you can populate from existing tables
-- Tables: report_runs (one per generated report), report_entries (rows per appointment)

CREATE TABLE IF NOT EXISTS report_runs (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  name VARCHAR(150) NOT NULL,
  department VARCHAR(150) NULL,
  start_date DATE NULL,
  end_date DATE NULL,
  generated_by VARCHAR(100) NULL,
  generated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  KEY idx_period (start_date, end_date),
  KEY idx_department (department)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS report_entries (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  run_id INT UNSIGNED NOT NULL,
  controlcode VARCHAR(100) NOT NULL,
  reservation_date DATE NULL,
  last_name VARCHAR(150) NULL,
  first_name VARCHAR(150) NULL,
  contact VARCHAR(50) NULL,
  email VARCHAR(200) NULL,
  address VARCHAR(255) NULL,
  department VARCHAR(150) NULL,
  venue VARCHAR(150) NULL,
  time_display VARCHAR(100) NULL,
  activity_date DATE NULL,
  purpose TEXT NULL,
  status ENUM('PENDING','ACCEPTED','COMPLETED','CANCELLED') NULL,
  feedback_rating TINYINT UNSIGNED NULL,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  KEY idx_run (run_id),
  KEY idx_controlcode (controlcode),
  CONSTRAINT fk_report_entries_run
    FOREIGN KEY (run_id) REFERENCES report_runs(id)
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Optional helper view to mirror current live report data without persisting
-- You can DROP this if you prefer only persisted snapshots
CREATE OR REPLACE VIEW v_live_appointment_report AS
SELECT 
  a.CONTROLCODE AS controlcode,
  DATE(a.DATEON) AS reservation_date,
  a.LASTNAME AS last_name,
  a.FIRSTNAME AS first_name,
  a.CONTACT AS contact,
  a.EMAIL AS email,
  a.ADDRESS AS address,
  a.DEPARTMENT AS department,
  v.CATEGORYNAME AS venue,
  v.VENUETIME AS time_display,
  DATE(v.VENUEDATE) AS activity_date,
  a.REMARKS AS purpose,
  a.STATUS AS status,
  (
    SELECT qf.rating 
    FROM question_feedback qf 
    WHERE qf.appointid = a.CONTROLCODE 
    ORDER BY qf.id DESC LIMIT 1
  ) AS feedback_rating
FROM tbl_appointment a
JOIN tbl_venuelists v ON a.CONTROLCODE = v.CONTROLCODE
GROUP BY a.CONTROLCODE;

-- To load a snapshot into report_entries for a given run_id, example:
-- INSERT INTO report_entries (
--   run_id, controlcode, reservation_date, last_name, first_name, contact, email, address,
--   department, venue, time_display, activity_date, purpose, status, feedback_rating
-- )
-- SELECT
--   @run_id, controlcode, reservation_date, last_name, first_name, contact, email, address,
--   department, venue, time_display, activity_date, purpose, status, feedback_rating
-- FROM v_live_appointment_report;


-- Default migration to improve reporting performance and add metadata
-- Run these on your live DB (idempotent guards included)

ALTER TABLE tbl_appointment
  ADD COLUMN IF NOT EXISTS created_at DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
  ADD COLUMN IF NOT EXISTS updated_at DATETIME NULL ON UPDATE CURRENT_TIMESTAMP,
  ADD INDEX IF NOT EXISTS idx_appointment_dateon (DATEON),
  ADD INDEX IF NOT EXISTS idx_appointment_department (DEPARTMENT),
  ADD INDEX IF NOT EXISTS idx_appointment_control (CONTROLCODE);

ALTER TABLE tbl_venuelists
  ADD INDEX IF NOT EXISTS idx_venue_control (CONTROLCODE),
  ADD INDEX IF NOT EXISTS idx_venue_date (VENUEDATE);

-- Optional normalization: add department_id while keeping string DEPARTMENT for compatibility
ALTER TABLE tbl_department
  ADD INDEX IF NOT EXISTS idx_department_name (DEPARTMENTNAME);

ALTER TABLE tbl_appointment
  ADD COLUMN IF NOT EXISTS department_id INT NULL,
  ADD INDEX IF NOT EXISTS idx_department_id (department_id);

-- Foreign key is optional; uncomment if you want strict enforcement and department ids available
-- ALTER TABLE tbl_appointment
--   ADD CONSTRAINT fk_appointment_department
--   FOREIGN KEY (department_id) REFERENCES tbl_department(ID)
--   ON UPDATE CASCADE ON DELETE SET NULL;

