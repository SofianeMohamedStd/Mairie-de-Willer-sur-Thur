# Platforme Citoyenne

# Platforme Citoyenne

# partie UML

A choice represents the answer(s) that the user has chosen for a given question. From this description we can deduce two pieces of information : 
- A choice is linked to a question.
- A question is related to several choices (several users can answer the same question).
Between the entity of choice and question, we have a ManyToOne relationship.

In the same logic,
- A choice may contain multiple answers (for multiple choice questions).
- An answer is linked to several choices (several users can choose the same answers for a given question).
So we have a ManyToMany relationship between choice and response entities.

Participation in a poll can therefore be completed by recording all user choices,
- A participation contains several choices.
- A choice is linked to one participation.
The relationship between the participation and choice entity is a ManyToOne relationship.


