CREATE TABLE IF NOT EXISTS clubs (
  "id" INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
  "name" TEXT NOT NULL,
  "ori_name" TEXT NOT NULL UNIQUE,
  "league" TEXT DEFAULT NULL
);

CREATE TABLE IF NOT EXISTS players (
  "id" INTEGER NOT NULL PRIMARY KEY,
  "player_name" TEXT NOT NULL,
  "squad_number" INTEGER DEFAULT NULL,
  "team_name" TEXT DEFAULT NULL,
  "league" TEXT DEFAULT NULL,
  "nationality" TEXT DEFAULT NULL,
  "region" TEXT DEFAULT NULL,
  "height" INTEGER DEFAULT NULL,
  "weight" INTEGER DEFAULT NULL,
  "age" INTEGER DEFAULT NULL,
  "foot" TEXT DEFAULT NULL,
  "condition" TEXT DEFAULT NULL,
  "position" TEXT DEFAULT NULL,
  "playing_styles" TEXT DEFAULT NULL
);

CREATE TABLE IF NOT EXISTS player_abilities (
  "player_id" INTEGER NOT NULL PRIMARY KEY,
  "attacking_prowess" INTEGER NOT NULL,
  "ball_control" INTEGER DEFAULT NULL,
  "dribbling" INTEGER DEFAULT NULL,
  "low_pass" INTEGER DEFAULT NULL,
  "lofted_pass" INTEGER DEFAULT NULL,
  "finishing" INTEGER DEFAULT NULL,
  "place_kicking" INTEGER DEFAULT NULL,
  "swerve" INTEGER DEFAULT NULL,
  "header" INTEGER DEFAULT NULL,
  "defensive_prowess" INTEGER DEFAULT NULL,
  "ball_winning" INTEGER DEFAULT NULL,
  "kicking_power" INTEGER DEFAULT NULL,
  "speed" INTEGER DEFAULT NULL,
  "explosive_power" INTEGER DEFAULT NULL,
  "body_control" INTEGER DEFAULT NULL,
  "physical_contact" INTEGER DEFAULT NULL,
  "jump" INTEGER DEFAULT NULL,
  "stamina" INTEGER DEFAULT NULL,
  "goalkeeping" INTEGER DEFAULT NULL,
  "catching" INTEGER DEFAULT NULL,
  "clearing" INTEGER DEFAULT NULL,
  "reflexes" INTEGER DEFAULT NULL,
  "coverage" INTEGER DEFAULT NULL,
  "overall_rating" INTEGER DEFAULT NULL,
  "max_level" INTEGER DEFAULT NULL,
  "overall_at_max_level" INTEGER DEFAULT NULL,
  "lvup_data" TEXT DEFAULT NULL
);
