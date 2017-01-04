		
<div class="maincontentinner">
                <div class="row-fluid">
                    <div id="dashboard-left" class="span12" style="min-height:400px">
					<a href="<?php echo $this->page->base_url();?>/add" class="btn btn-success" style="margin-bottom:10px;color:white"><i class="icon-plus icon-white"></i> &nbsp;Add New School / Organization</a>
                <table id="dyntable" class="table table-bordered">
                   
					<colgroup>
                        <col class="con0" style="align: center; width: 4%" />
                        <col class="con1" />
                        <col class="con0" />
                        <col class="con1" />
                    </colgroup>
               <thead>
				<tr>
					<th>No</th>
					<th>Organization Code</th>
					<th>Organization Name</th>
					<th>City</th>
					<th>Region</th>
					<th>Country</th>
					<th>Phone</th>
					<th>Email</th>
					<th>Reg Date</th>
					<th>Action</th>
				</tr>
				</thead>
				<tbody id="trow">
					<?php $no=1; foreach($org as $row){?>
					<tr style="font-size:9pt">
						<td><?php echo $no;?></td>
						<td><?php echo $row->code;?></td>
						<td><?php echo $row->name;?></td>
						<td><?php echo city($row->city);?></td>
						<td><?php echo region($row->region);?></td>
						<td><?php echo country($row->country);?></td>
						<td><?php echo $row->phone;?></td>
						<td><?php echo $row->email;?></td>
						<td><?php echo $row->reg_date;?></td>
						<td>
						<a href="#" class="btn btn-primary btns" ><i class="icon-edit icon-white"></i></a>
						<button type="button" class="btn btn-danger btns" onclick="removes('<?php echo $row->id;?>')"><i class="icon-remove icon-white"></i></button>
						</td>
					</tr>
					<?php $no++; } ?>
				</tbody>
			</table>				
                    </div><!--span8-->
                    
                </div><!--row-fluid-->
                <!--
                <div class="footer">
                    <div class="footer-left">
                        <span>&copy; 2016 PT Minda Perdana Indonesia</span>
                    </div>
                    <div class="footer-right">
                        <span>Parent Teacher As Partner Application</span>
                    </div>
                </div><!--footer-->
                
            </div><!--maincontentinner-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close exit" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Country Form</h4>
            </div>
                <div class="modal-body" style="">  
				<form id="form" class="form-horizontal">
					<div class="control-group" id="">
                        <label class="control-label">Country Name</label>
                        <div class="controls">
							<input type="hidden" name="country_code" id="country_code">
                            <input type="text" class="span3" name="country_name" placeholder="Country Name" id="country_name" class="form-control" value="" required/>
                        </div>
                    </div>	
				</form>
                </div> 
                <div class="modal-footer">
                    <button type="button" class="btn btn-default exit" data-dismiss="modal">Exit</button>
                    <input type="submit" class="btn btn-primary" value="Save"  data-dismiss="modal" id="save"/>
                </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal --></div>	