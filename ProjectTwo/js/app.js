//application level variables
var currentObject = {};

//set up your database
var db = new Dexie("happyThoughts");

db.version(1).stores({
    thoughts: 'id++, title, time, happiness'
});

//open the database
db.open();

//get reference to the pages on the screen
var listPage = $("#listPage");
var addPage = $("#addPage");
var editPage = $("#editPage");
var showPage = $("#showPage");

//hide those pages
$(".page").hide();

//hook up navigation
$("#btnAddNew").click(function(){

    //hides all pages
    $(".page").hide();

    //shows the addPage
    addPage.show();
});

//showing the quick event add page
$("#btnQuickAdd").click(function() {

    //hide all of the other pages
    $(".page").hide()

    //show the quickAdd page
    $("#quickAdd").show();

});

//interaction events
function listThoughts() {

    //hides all pages
    $(".page").hide();

    //shows the list page
    listPage.show();

    var thoughtListingEL = listPage.find(".thoughts");

    //clear out the inputs
    thoughtListingEL.html("");

    //loop through each thought in the db
    db.thoughts.orderBy('time').reverse().each(function(thought) {
        thoughtListingEL.append("<div><span data-id='"+thought.id+"' class='thoughtLink'>" + thought.title + "</span> <span data-id='"+thought.id+"' class='editLink'>edit</span> <span data-id='"+thought.id+"' class='deleteLink'>[x]</span> </div>");
    })
}

$("#btnListAll").click(listThoughts);

listPage.on("click", ".deleteLink", function() {

    //get the thoughtID
    var thoughtID = Number($(this).attr('data-id'));

    //delete element
    db.thoughts.delete(thoughtID).then(function() {
        listThoughts();
    })
});

//find edit link
listPage.on("click", ".editLink", function() {
    //hide all pages
    $(".page").hide();

    //get the thoughtID
    var thoughtID = Number($(this).attr('data-id'));

    //query dexie for that thought
    db.thoughts.get(thoughtID).then(function (thoughtObj) {

        //store the object that was just loaded
        currentObject = thoughtObj;

        //show the edit page
        $(editPage).show();

        //plug in the edit information
        editPage.find(".title").val(thoughtObj.title);
        editPage.find(".description").val(thoughtObj.description);
        editPage.find(".tags").val(thoughtObj.tags.toString());
        editPage.find(".happiness").val(thoughtObj.happiness);

    });
});

//find thought link
listPage.on("click", ".thoughtLink", function() {

    //hides all pages
    $(".page").hide();

    //get the thought id
    var thoughtID = Number($(this).attr('data-id'));

    db.thoughts.get(thoughtID).then(function (thoughtObj) {

        //hide all the pages
        $(".page").hide();

        //show the show page
        $("#showPage").show();

        //update info in the show page
        showPage.find(".thoughtTitle").html(thoughtObj.title);
        showPage.find(".thoughtDescription").html(thoughtObj.description);

        var d = new Date(thoughtObj.time);
        showPage.find(".thoughtDate").html((d.getMonth() + 1) + "/" + d.getDate() + "/" + d.getFullYear());
    });
});

$("#btnSubmitEdit").click(function() {

    //adding a couple variables to add some validation
    var isValid = true;
    var editTitle = $("#editTitle").val();
    var editDescription = $("#editDesc").val();

    //checks to make sure you don't delete your title
    if (editTitle == "") {
        $("#editTitleError").html("Please Add a title.");

        isValid = false;
    }

    if (editDescription == "" ) {
        $("#editDescError").html("Please enter a description.");

        isValid = false;
    }

    if (isValid == false) {
        return;
    }

    //changes the value of the current object
    currentObject.title = editPage.find(".title").val();
    currentObject.description = editPage.find(".description").val();
    currentObject.tags = editPage.find(".tags").val().split(",");
    currentObject.happiness = Number(editPage.find(".happiness").val());

    //put will "update" the data in the database -
    //so long as this objects ID matches any in the DB
    db.thoughts.put(currentObject).then(function() {

        //move to the thoughts page
        listThoughts();
    })


});

$("#btnAddThought").click(function(){

    //gather the input information
    var thoughtTitle = $("#txtTitle").val();
    var thoughtDescription = $("#txtThought").val();
    var thoughtTags = $("#txtTags").val();
    var thoughtHappiness = Number($("#txtHappiness").val());

    //must be included to submit if there was a previous error
    var isValid = true;

    //find the error divs
    var addTitleError = document.querySelector("#addTitleError");
    var addDescError = document.querySelector("#addDescError");

    //validation
    if(thoughtTitle == "" ) {

        //add an error message
        addTitleError.innerHTML = "Please add a title.";

        isValid = false;
    }

    if (thoughtDescription == "" ) {

        //add an error message
        addDescError.innerHTML = "Please add a description.";

        isValid = false;
    }

    //check to see if form did not pass
    if (isValid == false) {
        return;
    }

    //get the time
    var d = new Date();
    var thoughtTime = d.getTime();

    //clean up data
    var tagArray = thoughtTags.split(",");

    //turn data into object
    var objThought = {
        title: thoughtTitle,
        description: thoughtDescription,
        time: thoughtTime,
        tags: tagArray,
        happiness: thoughtHappiness
    };

    db.thoughts.add(objThought).then(function() {

        //after submission clear the inputs
        $("#txtTitle").val("");
        $("#txtThought").val("");
        $("#txtTags").val("");
        $("#txtAddFeedback").html("Thought added.").show().hide(7000);
    });
});

$("#btnShowTop").click(function(){

    //hides all pages
    $(".page").hide();

    //shows the list page
    listPage.show();

    var thoughtListingEL = listPage.find(".thoughts");

    //clear out the inputs
    thoughtListingEL.html("");

    //loop through each thought in the db
    db.thoughts.where('happiness').above(5.5).each(function(thought) {
        thoughtListingEL.append("<div><span data-id='"+thought.id+"' class='thoughtLink'>" + thought.title + "</span> <span data-id='"+thought.id+"' class='editLink'>edit</span> <span data-id='"+thought.id+"' class='deleteLink'>[x]</span> </div>");
    });
});

//quick event add
$("#addQuickThought").click(function() {

    //gather the input information
    var quickAddEvent = $("#quickAddEvent").val();

    //creating isValid
    var isValid = true;

    //referencing the error div
    var quickAddError = $("#quickEventError");

    //validating the input
    if(quickAddEvent == "" ) {

        //add an error message
        quickAddError.innerHTML = "Please add a title.";

        isValid = false;
    }

    //check to see if form did not pass
    if (isValid == false) {
        return;
    }

    //get the time
    var d = new Date();
    var eventTime = d.getTime();

    //turn data into object
    var objThought = {
        title: quickAddEvent,
        time: eventTime
    };

    db.thoughts.add(objThought).then(function() {

        //after submission clear the inputs
        $("#quickAddEvent").val("");
        $("#quickAddConf").html("Your event has been added!").show().hide(7000);
    });

});

//clears out the error divs if there is a focus on their input
$("#txtTitle").focus(function() {
    $("#addTitleError").html("");
});

$("#txtThought").focus(function() {
    $("#addDescError").html("");
});

$("#editTitle").focus(function() {
    $("#editTitleError").html("");
});

$("#editDesc").focus(function() {
    $("#editDescError").html("");
});