using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;

public class NounLinkage : MonoBehaviour
{
    [Tooltip("the corresponding noun text")]
    public Text nounText;
    [Tooltip("assign with IsResult component")]
    public IsResult resultTrigger;
    [Tooltip("assign with TimerUtility component")]
    public TimerUtility timer;
    public int timeBonus;

    private void isArgsNull()
    {
        if (nounText == null || resultTrigger == null || timer == null)
        {
            NounLinkage component = this.gameObject.GetComponent<NounLinkage>();
            Destroy(component);

            Debug.Log(string.Format("Null arguments : the component won't work"));
        }
    }

    private void clickNounObject()
    {
        if (nounText.gameObject.activeSelf)
        {
            nounText.gameObject.SetActive(false);
            Debug.Log(string.Format("Disable noun '{0}' text '{1}' successful",
                this.gameObject.name, nounText.text));

            // inactive the noun object
            // this.gameObject.SetActive(false);

            // increase player score
            DataSystem.scoreUp(1);

            // time bonus
            timer.timeUp(timeBonus);
        }
    }

    /* ********************************************************************************* *
     * ****************************** CUSTOM STUFFS ABOVE ****************************** *
     * ********************************************************************************* */

    private void OnMouseDown()
    {
        clickNounObject();
        resultTrigger.isAllNounClicked();
    }

    // Start is called before the first frame update
    void Start()
    {
        isArgsNull();
    }

    // Update is called once per frame
    void Update()
    {
        
    }
}
