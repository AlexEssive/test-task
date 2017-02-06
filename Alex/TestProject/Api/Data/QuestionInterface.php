<?php

namespace Alex\TestProject\Api\Data;

interface QuestionInterface
{
    /**
     * Get ID.
     *
     * @return int
     */
    public function getId();

    /**
     * Set ID.
     *
     * @param int $id
     * @return $this
     */
    public function setId($id);

    /**
     * Get name.
     *
     * @return string
     */
    public function getName();

    /**
     * Set name.
     *
     * @param string $name
     * @return $this
     */
    public function setName($name);

    /**
     * Get email.
     *
     * @return string
     */
    public function getEmail();

    /**
     * Set email.
     *
     * @param string $email
     * @return $this
     */
    public function setEmail($email);

    /**
     * Get phone.
     *
     * @return string
     */
    public function getTelephone();

    /**
     * Set phone.
     *
     * @param string $phone
     * @return $this
     */
    public function setTelephone($telephone);


    /**
     * Get comment.
     *
     * @return string
     */
    public function getComment();

    /**
     * Set comment.
     *
     * @param string $comment
     * @return $this
     */
    public function setComment($comment);

}