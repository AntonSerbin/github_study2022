<div class="parent">

    <form name="newDataForm" method="post" action="datalist.php">
        <label for="newString">Enter new info</label><br>
        <input name="newString" type="text"><br>

        <select name="typeAdd">
            <option value="fileTXTType">Text file</option>
            <option value="fileCSVType">CSV file</option>
            <option value="tableSQLType" selected>Table SQL</option>
        </select><br>
        <input type="submit">

    </form>
</div>