ALTER TABLE `todo` ADD `userID` INT(11) NOT NULL AFTER `todoID`, ADD INDEX `userID` (`userID`);
update `todo` SET userID='1'