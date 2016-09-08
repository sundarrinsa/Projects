var rowCount;
var count;
var total=0;
function addRow1(tableID) {
	total++;
            var table = document.getElementById(tableID);
             rowCount = table.rows.length;
            var colCount = table.rows[1].cells.length;
			 count=rowCount;
			count=(count+1)/2;
//document.getElementById('goal').value=total;
document.getElementById('aim0').name=total;
           
		
        }
        function removeRow(src) {

            var oRow = src.parentElement.parentElement;
            var rowsCount = 0;
            for(var index = oRow.rowIndex; index >= 0; index--) {

                document.getElementById("dataTable").deleteRow(index);
                if(rowsCount == (1)) {
                    return;
                }
                rowsCount++;
				total--;
				//document.getElementById('goal').value=(total);
            }
            
        }