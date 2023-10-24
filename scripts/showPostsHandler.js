const postsWrapper = document.getElementById("postsWrapper");
const loadMoreButton = document.getElementById("loadMoreButton");

let displayedPosts = 0;

function displayPosts(startIndex, endIndex) {
  for (let i = startIndex; i < endIndex; i++) {
    const post = friendsPosts[i];
    const postElement = document.createElement("div");
    postElement.className = "status_post";
    postElement.style.border = "1px solid #ccc";
    postElement.style.borderRadius = "5px";
    postElement.style.padding = "15px";

    const profilePicElement = document.createElement("div");
    profilePicElement.className = "post_profile_pic";

    const profilePicImage = document.createElement("img");
    profilePicImage.src = "/facebook/public/images/head_alizarin.png";
    profilePicElement.appendChild(profilePicImage);

    postElement.appendChild(profilePicElement);

    const postedByElement = document.createElement("div");
    postedByElement.className = "posted_by";
    postedByElement.style.width = "80%";
    postedByElement.style.padding = "0 10px";

    const postedByLink = document.createElement("a");
    postedByLink.href = `/user/${post.added_by}`;
    postedByLink.textContent = post.added_by;
    postedByElement.appendChild(postedByLink);

    const userToText = post.user_to !== "none" ? "   everybody" : post.user_to;
    const userToTextNode = document.createTextNode(" to " + userToText);
    postedByElement.appendChild(userToTextNode);

    const postDateElement = document.createElement("span");
    postDateElement.className = "post_date";
    postDateElement.textContent = post.date_added;
    postedByElement.appendChild(document.createElement("br"));
    postedByElement.appendChild(postDateElement);
    postedByElement.appendChild(document.createElement("br"));

    const postBodyElement = document.createElement("div");
    postBodyElement.className = "post_body";

    const postBodyTextElement = document.createElement("span");
    postBodyTextElement.className = "post_body";
    postBodyTextElement.textContent = post.body;
    postBodyElement.appendChild(postBodyTextElement);

    postedByElement.appendChild(postBodyElement);
    postElement.appendChild(postedByElement);

    postsWrapper.appendChild(postElement);

    //load more button styling
    loadMoreButton.innerHTML = '<i class="fa fa-arrow-down"></i>';
    loadMoreButton.style.display = "block";
    loadMoreButton.style.margin = "10px auto";
    loadMoreButton.style.fontSize = "24px";
    loadMoreButton.style.padding = "10px 20px";
    loadMoreButton.style.border = "none";
    loadMoreButton.style.backgroundColor = "transparent";
    loadMoreButton.style.color = "#1e3a6f";

    postsWrapper.appendChild(loadMoreButton);

    //Comment Section
    const commentWrapperElement = document.createElement("div");
    commentWrapperElement.style.width = "90%";
    commentWrapperElement.style.maxHeight = "70px";
    commentWrapperElement.style.overflow = "auto";
    commentWrapperElement.style.border = "1px solid #ccc";
    commentWrapperElement.style.borderRadius = "5px";
    commentWrapperElement.style.padding = "5px 20px 5px 10px";
    commentWrapperElement.style.margin = "10px 0";

    if (post.comments !== null) {
      JSON.parse(post.comments).map(function (c) {
        const commentDiv = document.createElement("div");
        commentDiv.style.display = "flex";
        commentDiv.style.flexDirection = "column";
        commentDiv.style.width = "fit-content";
        commentDiv.style.minWidth = "250px";
        commentDiv.style.marginBottom = "8px";

        const commentAuthor = document.createElement("a");
        commentAuthor.href = `/user/${post.added_by}`;
        commentAuthor.textContent = c.posted_by;
        commentAuthor.style.color = "#3b5998";
        commentAuthor.style.fontStyle = "italic";

        const commentBody = document.createElement("p");
        commentBody.textContent = c.post_body;
        commentBody.style.marginLeft = "5px";
        commentBody.style.fontSize = "13px";

        commentDiv.appendChild(commentAuthor);
        commentDiv.appendChild(commentBody);

        if (c.posted_by === authUser) {
          //delete comment form
          const deleteCommentForm = document.createElement("form");
          deleteCommentForm.method = "POST";
          deleteCommentForm.action = "/comment";
          deleteCommentForm.style.width = "20px";
          deleteCommentForm.style.float = "right";

          const deleteCommentFormTokenInput = document.createElement("input");
          deleteCommentFormTokenInput.type = "hidden";
          deleteCommentFormTokenInput.name = "csrf_token";
          deleteCommentFormTokenInput.value = csrfToken;

          const deleteCommentFormMethodInput = document.createElement("input");
          deleteCommentFormMethodInput.type = "hidden";
          deleteCommentFormMethodInput.name = "_method";
          deleteCommentFormMethodInput.value = "DELETE";

          const deleteCommentFormPostId = document.createElement("input");
          deleteCommentFormPostId.type = "hidden";
          deleteCommentFormPostId.name = "post_id";
          deleteCommentFormPostId.value = post.id;

          const deleteCommentFormCommentId = document.createElement("input");
          deleteCommentFormCommentId.type = "hidden";
          deleteCommentFormCommentId.name = "comment_id";
          deleteCommentFormCommentId.value = c?.post_comment_id;

          const submitCommentDeleteForm = document.createElement("button");
          submitCommentDeleteForm.type = "submit";
          submitCommentDeleteForm.className = "fa fa-times-circle";
          submitCommentDeleteForm.style.color = "red";
          submitCommentDeleteForm.style.border = "none";
          submitCommentDeleteForm.style.backgroundColor = "transparent";
          submitCommentDeleteForm.style.marginLeft = "5px";
          submitCommentDeleteForm.style.cursor = "pointer";

          deleteCommentForm.appendChild(deleteCommentFormTokenInput);
          deleteCommentForm.appendChild(deleteCommentFormMethodInput);
          deleteCommentForm.appendChild(deleteCommentFormPostId);
          deleteCommentForm.appendChild(deleteCommentFormCommentId);
          deleteCommentForm.appendChild(submitCommentDeleteForm);

          commentWrapperElement.appendChild(deleteCommentForm);
          //end delete post form
        }

        return commentWrapperElement.appendChild(commentDiv);
      });

      postedByElement.appendChild(commentWrapperElement);
    }
    //End comment section

    //Add comment toggler
    const addCommentParagraph = document.createElement("span");
    addCommentParagraph.textContent = "ADD NEW COMMENT";
    addCommentParagraph.style.fontSize = "small";
    addCommentParagraph.style.color = "#3b5998";
    addCommentParagraph.addEventListener("mouseover", function () {
      addCommentParagraph.style.color = "#1e3a6f";
    });
    addCommentParagraph.addEventListener("mouseout", function () {
      addCommentParagraph.style.color = "#3b5998";
    });
    addCommentParagraph.addEventListener("click", function () {
      if (form.style.display === "none") {
        form.style.display = "block";
      } else {
        form.style.display = "none";
      }
    });
    postedByElement.appendChild(addCommentParagraph);
    //END TOGGLER

    // form
    const form = document.createElement("form");
    form.action = "/comment";
    form.method = "POST";
    form.style.display = "none";
    form.style.flexDirection = "column";

    const csrfTokenInput = document.createElement("input");
    csrfTokenInput.type = "hidden";
    csrfTokenInput.name = "csrf_token";
    csrfTokenInput.value = csrfToken;

    const postIdInput = document.createElement("input");
    postIdInput.type = "hidden";
    postIdInput.name = "post_id";
    postIdInput.value = post.id;

    const commentInput = document.createElement("textarea");
    commentInput.name = "post_comment";
    commentInput.required = "true";
    commentInput.id = "post_comment";
    commentInput.placeholder = "Got something to say?...";
    commentInput.style.width = "100%";
    commentInput.style.padding = "1px 2px";
    commentInput.style.margin = "5px 0";
    commentInput.style.resize = "none";

    const submitButton = document.createElement("button");
    submitButton.type = "submit";
    submitButton.textContent = "ADD COMMENT";
    submitButton.style.padding = "3px 8px";
    submitButton.style.width = "fit-content";
    submitButton.style.color = "#fff";
    submitButton.style.backgroundColor = "#3b5998";
    submitButton.style.borderRadius = "5px";
    submitButton.style.border = "none";
    submitButton.addEventListener("mouseover", function () {
      submitButton.style.backgroundColor = "#1e3a6f";
    });
    submitButton.addEventListener("mouseout", function () {
      submitButton.style.backgroundColor = "#3b5998";
    });

    form.appendChild(csrfTokenInput);
    form.appendChild(postIdInput);
    form.appendChild(commentInput);
    form.appendChild(submitButton);

    postedByElement.appendChild(form);
    //end form

    if (authUser === post.added_by) {
      const deletePostDiv = document.createElement("div");
      //delete post form
      const deletePostForm = document.createElement("form");
      deletePostForm.method = "POST";
      deletePostForm.action = "/post";

      const deleteFormTokenInput = document.createElement("input");
      deleteFormTokenInput.type = "hidden";
      deleteFormTokenInput.name = "csrf_token";
      deleteFormTokenInput.value = csrfToken;

      const deleteFormMethodInput = document.createElement("input");
      deleteFormMethodInput.type = "hidden";
      deleteFormMethodInput.name = "_method";
      deleteFormMethodInput.value = "DELETE";

      const deleteFormPostId = document.createElement("input");
      deleteFormPostId.type = "hidden";
      deleteFormPostId.name = "post_id";
      deleteFormPostId.value = post.id;

      const submitDeleteForm = document.createElement("button");
      submitDeleteForm.type = "submit";
      submitDeleteForm.className = "fa fa-times-circle";
      submitDeleteForm.style.float = "right";
      submitDeleteForm.style.color = "red";
      submitDeleteForm.style.border = "none";
      submitDeleteForm.style.backgroundColor = "transparent";
      submitDeleteForm.style.marginLeft = "5px";
      submitDeleteForm.style.value = "submit";

      deletePostForm.appendChild(deleteFormTokenInput);
      deletePostForm.appendChild(deleteFormMethodInput);
      deletePostForm.appendChild(deleteFormPostId);
      deletePostForm.appendChild(submitDeleteForm);

      deletePostDiv.appendChild(deletePostForm);
      postElement.appendChild(deletePostDiv);
      //end delete post form
    }

    //likes section
    const likesWrapper = document.createElement("div");
    likesWrapper.style.width = "100%";
    likesWrapper.style.height = "15px";
    likesWrapper.style.display = "flex";
    likesWrapper.style.flexDirection = "row";
    likesWrapper.style.justifyContent = "end";

    const likeUpFormElement = document.createElement("form");
    likeUpFormElement.action = `/post/like`;
    likeUpFormElement.method = `POST`;

    const likeUpAction = document.createElement("input");
    likeUpAction.type = "hidden";
    likeUpAction.name = "action";
    likeUpAction.value = "increment";

    const likeUpPostIdInput = document.createElement("input");
    likeUpPostIdInput.type = "hidden";
    likeUpPostIdInput.name = "post_id";
    likeUpPostIdInput.value = `${post.id}`;

    const likeUpByUserInput = document.createElement("input");
    likeUpByUserInput.type = "hidden";
    likeUpByUserInput.name = "liked_by";
    likeUpByUserInput.value = authUser;

    const likeUpMethodInput = document.createElement("input");
    likeUpMethodInput.type = "hidden";
    likeUpMethodInput.name = "_method";
    likeUpMethodInput.value = "UPDATE";

    const likeUpButtonElement = document.createElement("button");
    likeUpButtonElement.className = "fa fa-thumbs-o-up";
    likeUpButtonElement.type = "submit";
    likeUpButtonElement.style.color = "#3b5998";
    likeUpButtonElement.style.backgroundColor = "transparent";
    likeUpButtonElement.style.border = "none";

    likeUpFormElement.appendChild(likeUpAction);
    likeUpFormElement.appendChild(likeUpPostIdInput);
    likeUpFormElement.appendChild(likeUpByUserInput);
    likeUpFormElement.appendChild(likeUpMethodInput);
    likeUpFormElement.appendChild(likeUpButtonElement);

    const likeTotal = document.createElement("span");
    likeTotal.textContent = `(${post.likes})`;
    likeTotal.style.color = `#3b5998`;
    likeTotal.style.margin = "0 5px";

    const likeDownFormElement = document.createElement("form");
    likeDownFormElement.action = `/post/dislike`;
    likeDownFormElement.method = `POST`;

    const likeDownAction = document.createElement("input");
    likeDownAction.type = "hidden";
    likeDownAction.name = "action";
    likeDownAction.value = "decrement";

    const likeDownPostIdInput = document.createElement("input");
    likeDownPostIdInput.type = "hidden";
    likeDownPostIdInput.name = "post_id";
    likeDownPostIdInput.value = `${post.id}`;

    const likeDownByUserInput = document.createElement("input");
    likeDownByUserInput.type = "hidden";
    likeDownByUserInput.name = "liked_by";
    likeDownByUserInput.value = authUser;

    const likeDownMethodInput = document.createElement("input");
    likeDownMethodInput.type = "hidden";
    likeDownMethodInput.name = "_method";
    likeDownMethodInput.value = "UPDATE";

    const likeDownButtonElement = document.createElement("button");
    likeDownButtonElement.className = "fa fa-thumbs-o-down";
    likeDownButtonElement.type = "submit";
    likeDownButtonElement.style.color = "#3b5998";
    likeDownButtonElement.style.backgroundColor = "transparent";
    likeDownButtonElement.style.border = "none";

    likeDownFormElement.appendChild(likeDownAction);
    likeDownFormElement.appendChild(likeDownPostIdInput);
    likeDownFormElement.appendChild(likeDownByUserInput);
    likeDownFormElement.appendChild(likeDownMethodInput);
    likeDownFormElement.appendChild(likeDownButtonElement);

    likesWrapper.appendChild(likeUpFormElement);
    likesWrapper.appendChild(likeTotal);
    likesWrapper.appendChild(likeDownFormElement);

    postedByElement.appendChild(likesWrapper);
    //end likes
  }
}

function loadMorePosts() {
  const remainingPosts = friendsPosts.length - displayedPosts;
  const postsToDisplay = Math.min(remainingPosts, 4);

  displayPosts(displayedPosts, displayedPosts + postsToDisplay);
  displayedPosts += postsToDisplay;

  if (remainingPosts <= 4) {
    loadMoreButton.style.display = "none";
  }
}

loadMoreButton.addEventListener("click", loadMorePosts);

loadMorePosts();
