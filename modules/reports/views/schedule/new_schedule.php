<?php defined('SYSPATH') OR die('No direct access allowed.'); ?>

<div id="new_schedule_area">
	<form action="schedule/schedule" id="new_schedule_report_form">

		<table class="setup-tbl padd-table">
			<tr>
				<td>
					<label for="type"><?php echo help::render('report-type-save', 'reports').' '._('Select report type') ?></label><br />
					<?php echo form::dropdown(array('name' => 'type'), $defined_report_types); ?>
				</td>
				<td>
					<label for="filename"><?php echo help::render('filename', 'reports').' '._('Filename (defaults to pdf, may end in .csv)') ?></label><br /><input type="text" class="schedule" name="filename" id="filename" value="" />
				</td>
			</tr>
			<tr>
				<td>
					<?php if (!empty($available_schedule_periods)) { ?>
						<label for="period"><?php echo help::render('interval', 'reports').' '._('Report interval') ?></label><br />
						<select name="period" id="period">
						<?php	foreach ($available_schedule_periods as $id => $period) { ?>
							<option value="<?php echo $id ?>"><?php echo $period ?></option>
						<?php	} ?>
						</select>
					<?php } ?>
				</td>
				<td>
					<label for="description"><?php echo help::render('description', 'reports').' '._('Description') ?></label><br />
					<textarea cols="31" rows="4" id="description" name="description"></textarea>
				</td>
			</tr>
			<tr>
				<td>
					<label for="saved_report_id"><?php echo help::render('select-report', 'reports').' '._('Select report') ?></label><br />
					<select name="saved_report_id" id="saved_report_id">
						<option value=""> - <?php echo _('Select saved report') ?> - </option>
					</select>
				</td>
				<td>
					<label for="attach_description"><?php echo help::render('attach_description', 'reports').' '._("Attach description") ?></label><br />
					<select name="attach_description" id="attach_description">
						<option value="0">No</option>
						<option value="1">Yes</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>
					<label for="recipients"><?php echo help::render('recipents', 'reports').' '._('Recipients') ?></label><br />
					<input type="text" class="schedule" name="recipients" id="recipients" value="" />
				</td>
				<td>
					<label for="local_persistent_filepath"><?php echo help::render('local_persistent_filepath', 'reports').' '._("Save report on Monitor Server?") ?></label><br /><input type="text" class="schedule" name="local_persistent_filepath" id="local_persistent_filepath" value="" />
				</td>
			</tr>
			<tr>
				<td class="label sub-heading">Schedule</td>
			</tr>
			<tr>
				<td>
					<div>Create and send at</div>
					<div style="position:relative">
						<input id="schedule-report-sendtime" class="time">
						<div id="sendtime-options" class="sendtime-quickselect quickselect hide"></div>
					</div>
				</td>
                </tr>
                <tr>
                	<td>
                		<div>Repeat every</div>
                		<div>
                			<input class="num" type="number" min="1" value="1">
                			<select id="sch-repeat-text-box" class="repeat-text">
                				<option value="day">Day</option>
                				<option value="week">Week</option>
                				<option value="month">Month</option>
                			</select>
                		</div>
                	</td>
                </tr>
                <tr>
                	<td>
                        <div id="sch-on" class="hide">On</div>
                        <div id="sch-week-opt" class="hide">
                           	<input class="hide" checked="checked" type="radio" name="week_on" value="">
                            <input wno="1" name="week_on_day[]" tag="week-Monday" type="checkbox" value='{"day":1}'>
                            <span wno="1" tag="Monday">Mon</span>
                            <input wno="2" name="week_on_day[]" tag="week-Tuesday" type="checkbox" value='{"day":2}'>
                            <span wno="2" tag="Tuesday">Tue</span>
                            <input wno="3" name="week_on_day[]" tag="week-Wednesday" type="checkbox" value='{"day":3}'>
                            <span wno="3" tag="Wednesday">Wed</span>
                            <input wno="4" name="week_on_day[]" tag="week-Thursday" type="checkbox" value='{"day":4}'>
                            <span wno="4" tag="Thursday">Thu</span>
                            <input wno="5" name="week_on_day[]" tag="week-Friday" type="checkbox" value='{"day":5}'>
                            <span wno="5" tag="Friday">Fri</span>
                            <input wno="6" name="week_on_day[]" tag="week-Saturday" type="checkbox" value='{"day":6}'>
                            <span wno="6" tag="Saturday">Sat</span>
                            <input wno="0" name="week_on_day[]" tag="week-Sunday" type="checkbox" value='{"day":7}'>
                            <span wno="0" tag="Sunday">Sun</span>
                        </div>
                        <div id="sch-month-opt" class="hide">
                            <div class="relative"><input id="sch-any-day-month" checked="checked" type="radio" name="sch-month-on"> the
                                    <select name="rec-on-no-box" id="rec-on-no-box" class="rec-on-no-box" value="">
                                        <option>first</option>
                                        <option>second</option>
                                        <option>third</option>
                                        <option>fourth</option>
                                        <option>last</option>
                                    </select>
                                    <select name="rec-on-day-box" id="rec-on-day-box" class="rec-on-day-box" value="">
                                        <option>Monday</option>
                                        <option>Tuesday</option>
                                        <option>Wednesday</option>
                                        <option>Thursday</option>
                                        <option>Friday</option>
                                        <option>Saturday</option>
                                        <option>Sunday</option>
                                    </select>
                            </div>
                            <div class="relative"><input id="sch-last-day-month" type="radio" name="last-day" name=""> the last day of the month </div>
                        </div>
                    </td>
                </tr>
			<tr>
				<td colspan="2">
					<span>
						<input type="submit" class="button save" value="<?php echo _('Save') ?>" />
						<input type="reset" class="button clear" value="<?php echo _('Clear') ?>" />
					</span>
				</td>
			</tr>
		</table>

	</form>
</div>
