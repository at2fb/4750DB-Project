<!DOCTYPE html>
<html>
<table>
    <tr>
    <th>Section ID
    </tr>

    <tbody id="data"></tbody>
</table>
</html>
<script>
    var ajax = new XMLHttpRequest();
    ajax.open("GET", "connect.php", true);
    ajax.send();

    ajax.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var data = JSON.parse(this.responseText);
            console.log(data);

            var html = "";
            for(var a = 0; a < data.length; a++) {
                var sectionID = data[a].sectionID;

                html += "<tr>";
                    html += "<td>" + sectionID + "</td>";
                html += "</tr>";
            }
            document.getElementById("data").innerHTML += html;
        }
    };
</script>
</html>