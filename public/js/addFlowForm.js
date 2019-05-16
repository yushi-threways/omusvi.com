var $collectionHolder;

// setup an "add a task" link
var $addFlowButton = $('<button type="button" class="add_flow_link btn btn-light btn-sm">Add a flow</button>');
var $newLinkLi = $('<div></div>').append($addFlowButton);


jQuery(document).ready(function() {
    // Get the ul that holds the collection of tasks
    $collectionHolder = $('div#my_event_flow');

    $collectionHolder.find('div#my_event_flow').each(function() {
        addFlowFormDeleteLink($(this));
    });

    // add the "add a tasks" anchor and li to the tasks ul
    $collectionHolder.append($newLinkLi);

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $collectionHolder.data('index', $collectionHolder.find(':input').length);

    $addFlowButton.on('click', function(e) {
        // add a new task form (see next code block)
        addFlowForm($collectionHolder, $newLinkLi);
    });
});


function addFlowForm($collectionHolder, $newLinkLi) {
    // Get the data-prototype explained earlier
    var prototype = $collectionHolder.data('prototype');

    // get the new index
    var index = $collectionHolder.data('index');

    var newForm = prototype;
    // You need this only if you didn't set 'label' => false in your tasks field in StatusType
    // Replace '__name__label__' in the prototype's HTML to
    // instead be a number based on how many items we have
    // newForm = newForm.replace(/__name__label__/g, index);

    // Replace '__name__' in the prototype's HTML to
    // instead be a number based on how many items we have
    newForm = newForm.replace(/__name__/g, index);

    // increase the index with one for the next item
    $collectionHolder.data('index', index + 1);

    // Display the form in the page in an li, before the "Add a flow" link li
    var $newFormLi = $('<div></div>').append(newForm);
    $newLinkLi.before($newFormLi);

    addFlowFormDeleteLink($newFormLi);
}

function addFlowFormDeleteLink($flowFormDiv) {
    var $removeFormButton = $('<button type="button" class="btn btn-dark btn-sm ">Delete this flow</button>');
    $flowFormDiv.append($removeFormButton);

    $removeFormButton.on('click', function(e) {
        // remove the li for the flow form
        $flowFormDiv.remove();
    });
}